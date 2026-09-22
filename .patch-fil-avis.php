<?php
// Formulaire : plus de champ d'ordre, et la date devient ce qui classe.
$f = 'app/Filament/Resources/Reviews/Schemas/ReviewForm.php';
$s = file_get_contents($f);

$old = "                        DatePicker::make('publie_le')\n"
     . "                            ->label('Publié sur Google le')\n"
     . "                            ->displayFormat('d/m/Y')\n"
     . "                            ->helperText('Facultatif. Affiché à côté de l’avis.'),\n\n"
     . "                        TextInput::make('ordre')\n"
     . "                            ->label('Ordre d’affichage')\n"
     . "                            ->numeric()\n"
     . "                            ->default(0)\n"
     . "                            ->required(),";

$new = "                        // C'est cette date qui classe les avis sur le site : le plus\n"
     . "                        // recent en premier. Il n'y a plus de champ d'ordre a la main.\n"
     . "                        DatePicker::make('publie_le')\n"
     . "                            ->label('Date de l’avis')\n"
     . "                            ->displayFormat('d/m/Y')\n"
     . "                            ->default(now())\n"
     . "                            ->required()\n"
     . "                            ->helperText('Les avis s’affichent du plus récent au plus ancien.'),";

if (substr_count($s, $old) !== 1) { fwrite(STDERR, "ancre formulaire introuvable\n"); exit(1); }
$s = str_replace($old, $new, $s);
$s = str_replace("use Filament\Forms\Components\TextInput;\n", "use Filament\Forms\Components\TextInput;\n", $s);
file_put_contents($f, $s);
echo "  formulaire : champ d'ordre retire, date obligatoire\n";

// Table : plus de colonne d'ordre, tri par date.
$f = 'app/Filament/Resources/Reviews/Tables/ReviewsTable.php';
$s = file_get_contents($f);

$old = "            ->defaultSort('ordre')";
$new = "            // Les avis en attente d'abord, puis du plus recent au plus ancien —\n"
     . "            // le meme ordre que sur le site.\n"
     . "            ->modifyQueryUsing(fn (Builder \$query) => \$query->orderBy('est_publie')->orderByDesc('publie_le'))";
if (substr_count($s, $old) !== 1) { fwrite(STDERR, "ancre tri introuvable\n"); exit(1); }
$s = str_replace($old, $new, $s);
$s = str_replace("use Filament\Tables\Table;", "use Filament\Tables\Table;\nuse Illuminate\Database\Eloquent\Builder;", $s);

$old2 = "                TextColumn::make('publie_le')\n                    ->label('Sur Google le')\n                    ->date('d/m/Y')\n                    ->placeholder('—')\n                    ->sortable(),";
$new2 = "                TextColumn::make('publie_le')\n                    ->label('Date')\n                    ->date('d/m/Y')\n                    ->placeholder('—')\n                    ->sortable(),";
if (substr_count($s, $old2) === 1) { $s = str_replace($old2, $new2, $s); }

file_put_contents($f, $s);
echo "  table : tri par date\n";
