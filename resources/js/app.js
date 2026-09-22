/* Bengal's Parc — interactions du site public.
   Volontairement sans dependance : menu, lecture de robe, lightbox, reveal, compteurs. */

const reduit = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/* ---------- menu mobile ---------- */
const burger = document.getElementById('burger');
const menu = document.getElementById('menu');

const syncMenu = () => {
    if (!burger || !menu) return;
    if (window.innerWidth > 1000) {
        menu.hidden = false;
        burger.setAttribute('aria-expanded', 'false');
    } else if (burger.getAttribute('aria-expanded') !== 'true') {
        menu.hidden = true;
    }
};

burger?.addEventListener('click', () => {
    const ouvert = burger.getAttribute('aria-expanded') === 'true';
    burger.setAttribute('aria-expanded', String(!ouvert));
    menu.hidden = ouvert;
});
window.addEventListener('resize', syncMenu);
syncMenu();

/* ---------- barre de navigation ---------- */
const nav = document.getElementById('nav');
window.addEventListener('scroll', () => nav?.classList.toggle('stuck', window.scrollY > 12), { passive: true });

/* ---------- lecture de robe ---------- */
const coat = document.getElementById('coat');
const coatInfo = document.getElementById('coatinfo');

if (coat && coatInfo) {
    const points = JSON.parse(coat.dataset.points || '[]');

    const afficher = (i) => {
        const p = points[i];
        if (!p) return;
        coatInfo.innerHTML =
            `<span class="k">${p.k}</span><h3>${p.t}</h3><p>${p.d}</p>`;
        coat.querySelectorAll('.hot').forEach((h) =>
            h.setAttribute('aria-pressed', String(Number(h.dataset.coat) === i)));
    };

    coat.addEventListener('click', (e) => {
        const b = e.target.closest('[data-coat]');
        if (b) afficher(Number(b.dataset.coat));
    });
    coat.addEventListener('mouseover', (e) => {
        const b = e.target.closest('[data-coat]');
        if (b) afficher(Number(b.dataset.coat));
    });
    afficher(0);
}

/* ---------- galerie : lightbox ---------- */
const masonry = document.getElementById('mas');
let lb = null;
let lbListe = [];
let lbIndex = 0;

const peindre = () => {
    const f = lbListe[lbIndex];
    lb.querySelector('img').src = f.dataset.full;
    lb.querySelector('img').alt = f.querySelector('img').alt;
    lb.querySelector('.cap').textContent =
        `${f.dataset.legende}  ·  ${lbIndex + 1} / ${lbListe.length}`;
};

const deplacer = (d) => {
    lbIndex = (lbIndex + d + lbListe.length) % lbListe.length;
    peindre();
};

const fermer = () => {
    if (!lb) return;
    lb.hidden = true;
    document.body.style.overflow = '';
};

masonry?.addEventListener('click', (e) => {
    const fig = e.target.closest('figure[data-full]');
    if (!fig) return;

    lbListe = [...masonry.querySelectorAll('figure[data-full]')];
    lbIndex = lbListe.indexOf(fig);

    if (!lb) {
        lb = document.createElement('div');
        lb.id = 'lb';
        lb.innerHTML =
            '<button class="x" type="button">Fermer</button><img alt=""><p class="cap"></p>' +
            '<div class="nav"><button type="button" data-d="-1">← Précédent</button>' +
            '<button type="button" data-d="1">Suivant →</button></div>';
        document.body.appendChild(lb);
        lb.addEventListener('click', (ev) => {
            if (ev.target === lb || ev.target.classList.contains('x')) return fermer();
            const b = ev.target.closest('[data-d]');
            if (b) deplacer(Number(b.dataset.d));
        });
        document.addEventListener('keydown', (ev) => {
            if (!lb || lb.hidden) return;
            if (ev.key === 'Escape') fermer();
            if (ev.key === 'ArrowLeft') deplacer(-1);
            if (ev.key === 'ArrowRight') deplacer(1);
        });
    }

    lb.hidden = false;
    document.body.style.overflow = 'hidden';
    peindre();
});

/* ---------- apparition au defilement + compteurs ---------- */
const compter = (el) => {
    const cible = parseInt(el.dataset.count, 10);
    if (Number.isNaN(cible)) return;
    if (reduit() || cible === 0) { el.textContent = cible; return; }

    const debut = performance.now();
    const tick = (t) => {
        const p = Math.min(1, (t - debut) / 900);
        el.textContent = Math.round(cible * (1 - Math.pow(1 - p, 3)));
        if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
};

if (!reduit()) {
    const io = new IntersectionObserver((entrees) => {
        entrees.forEach((e) => {
            if (!e.isIntersecting) return;
            e.target.classList.remove('pre');
            if (e.target.dataset.count !== undefined) compter(e.target);
            io.unobserve(e.target);
        });
    }, { rootMargin: '0px 0px -7% 0px' });

    const cibles = '.band .shead,.band .two,.grid>*,.repros>*,.cells>*,.masonry figure,.ledger .row,.legalgrid>*,.record';

    document.querySelectorAll(cibles).forEach((el, i) => {
        if (el.getBoundingClientRect().top > window.innerHeight * 1.02) {
            el.classList.add('reveal', 'pre');
            el.style.transitionDelay = `${Math.min(i, 5) * 40}ms`;
            io.observe(el);
        }
    });

    document.querySelectorAll('[data-count]').forEach((el) => {
        if (el.getBoundingClientRect().top < window.innerHeight * 1.02) compter(el);
        else io.observe(el);
    });

    // Filet de securite : rien ne doit rester invisible si l'observer ne declenche pas.
    setTimeout(() => document.querySelectorAll('.reveal.pre').forEach((el) => {
        if (el.getBoundingClientRect().top < window.innerHeight * 1.2) el.classList.remove('pre');
    }), 2200);
}

/* ---------- transitions de page : la photo suit le clic ----------

   Le navigateur sait deja fondre une page dans l'autre (regle
   @view-transition dans app.css). Ce bloc ajoute le seul detail qu'il ne
   peut pas deviner : quelle image de la liste correspond a la grande photo
   de la fiche. Une fois les deux nommees pareil, il ne les fait plus
   disparaitre puis reapparaitre — il deplace la meme image d'un cadre a
   l'autre.

   Le nom est pose au dernier moment et retire des la fin du trajet : deux
   elements portant le meme nom au meme instant annulent la transition, et
   le visiteur peut tres bien cliquer une deuxieme carte juste apres.

   pageswap se declenche sur la page qui part, pagereveal sur celle qui
   arrive. Les deux n'existent pas partout ; la ou elles manquent, il ne se
   passe rien de plus qu'avant. */

const NOM_VT = 'photo-fiche';

const photoDeLaFiche = () => document.querySelector('.detail .photo img');

const photoDeLaCarte = (url) => {
    if (!url) return null;
    const chemin = new URL(url, location.href).pathname;
    const lien = [...document.querySelectorAll('a.fiche, a.repro')]
        .find((a) => new URL(a.href, location.href).pathname === chemin);
    return lien?.querySelector('img') ?? null;
};

const nommer = (img, transition) => {
    if (!img) return;
    img.style.viewTransitionName = NOM_VT;
    transition?.finished.finally(() => { img.style.viewTransitionName = ''; });
};

window.addEventListener('pageswap', (e) => {
    if (!e.viewTransition) return;
    nommer(photoDeLaCarte(e.activation?.entry?.url) ?? photoDeLaFiche(), e.viewTransition);
});

window.addEventListener('pagereveal', (e) => {
    if (!e.viewTransition) return;
    // Sur une fiche c'est la grande photo ; sur une liste, la vignette d'ou
    // l'on vient — le retour arriere replie l'image sur sa carte.
    nommer(photoDeLaFiche() ?? photoDeLaCarte(window.navigation?.activation?.from?.url), e.viewTransition);
});
