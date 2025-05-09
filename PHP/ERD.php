<?php

class Profiel {
    public int $id;
    public string $bio;
    public string $foto;
    public string $voorkeuren;

    public function bewerken(string $bio, string $foto, string $voorkeuren): void {
        $this->bio = $bio;
        $this->foto = $foto;
        $this->voorkeuren = $voorkeuren;
    }
}

class Gebruiker {
    public int $id;
    public string $naam;
    public string $email;
    public string $wachtwoord;
    public Profiel $profiel;

    public function registreren(): void {
        // Registratie logica
    }

    public function inloggen(string $email, string $wachtwoord): bool {
        // Inlog logica
        return true;
    }

    public function uitloggen(): void {
        // Uitlog logica
    }
}

class Asiel {
    public int $id;
    public string $naam;
    public string $locatie;
    public string $contactgegevens;
    /** @var Dier[] */
    public array $dieren = [];

    public function dierToevoegen(Dier $dier): void {
        $this->dieren[] = $dier;
    }

    public function dierVerwijderen(Dier $dier): void {
        // Verwijder dier uit $this->dieren
    }
}

class Dier {
    public int $id;
    public string $naam;
    public string $soort;
    public string $ras;
    public int $leeftijd;
    public Asiel $asiel;
    public string $beschrijving;

    public function toevoegen(): void {
        // Toevoegen logica
    }

    public function bewerken(string $naam, string $soort, string $ras, int $leeftijd, string $beschrijving): void {
        $this->naam = $naam;
        $this->soort = $soort;
        $this->ras = $ras;
        $this->leeftijd = $leeftijd;
        $this->beschrijving = $beschrijving;
    }
}

class Swipe {
    public int $id;
    public Gebruiker $gebruiker;
    public Dier $dier;
    public string $richting; // 'LIKE' of 'DISLIKE'

    public function toevoegenSwipe(Gebruiker $gebruiker, Dier $dier, string $richting): void {
        // Swipe logica
    }
}

class MatchResult {
    public int $id;
    public Gebruiker $gebruiker;
    public Dier $dier;

    public function controlerenMatch(Gebruiker $gebruiker, Dier $dier): bool {

        return true;
    }
}

class Bericht {
    public int $id;
    public Gebruiker $afzender;
    public Asiel $ontvanger;
    public string $inhoud;
    public DateTime $verzendTijd;

    public function verzenden(): void {
        // Verzend logica
    }

    /** @return Bericht[] */
    public function ontvangen(): array {
        // Ontvang logica
        return [];
    }
}

class Favoriet {
    public int $id;
    public Gebruiker $gebruiker;
    public Dier $dier;
    public DateTime $datumToegevoegd;

    public function toevoegenFavoriet(Gebruiker $gebruiker, Dier $dier): void {
        // Favoriet toevoegen logica
    }

    public function verwijderenFavoriet(Gebruiker $gebruiker, Dier $dier): void {
        // Favoriet verwijderen logica
    }
}

class FilterSysteem {
    public int $id;
    public Gebruiker $gebruiker;
    public string $soort;
    public string $ras;
    public int $minLeeftijd;
    public int $maxLeeftijd;

    public function toepassenFilter(Gebruiker $gebruiker, string $soort, string $ras, int $minLeeftijd, int $maxLeeftijd): array {
        // Filter logica
        return [];
    }
}

class AdoptieAanvraag {
    public int $id;
    public Gebruiker $aanvrager;
    public Dier $dier;
    public string $status; // bijv. 'Ingediend', 'Goedgekeurd', 'Afgewezen'
    public DateTime $datumAanvraag;

    public function indienenAanvraag(Gebruiker $aanvrager, Dier $dier): void {
        // Aanvraag logica
    }

    public function wijzigStatus(string $status): void {
        $this->status = $status;
    }
}

class Review {
    public int $id;
    public Gebruiker $gebruiker;
    public Asiel $asiel;
    public int $beoordeling; // 1-5 sterren
    public string $opmerking;
    public DateTime $datum;

    public function toevoegenReview(Gebruiker $gebruiker, Asiel $asiel, int $beoordeling, string $opmerking): void {
        // Review logica
    }
}

class Notificatie {
    public int $id;
    public Gebruiker $ontvanger;
    public string $bericht;
    public bool $gelezen = false;
    public DateTime $verzendTijd;

    public function verzendenNotificatie(Gebruiker $ontvanger, string $bericht): void {
        // Notificatie logica
    }

    public function markeerAlsGelezen(): void {
        $this->gelezen = true;
    }
}

class BezoekAfspraak {
    public int $id;
    public Gebruiker $gebruiker;
    public Dier $dier;
    public Asiel $asiel;
    public DateTime $afspraakTijd;
    public string $status; // bijv. 'In afwachting', 'Bevestigd', 'Geannuleerd'

    public function plannenAfspraak(Gebruiker $gebruiker, Dier $dier, Asiel $asiel, DateTime $afspraakTijd): void {
        // Afspraak logica
    }

    public function wijzigStatus(string $status): void {
        $this->status = $status;
    }
}

class Admin {
    public int $id;
    public string $naam;
    public string $email;
    public string $wachtwoord;

    public function inloggen(string $email, string $wachtwoord): bool {
        // Admin inlog logica
        return true;
    }

    public function beheerActie(string $actie): void {
        // Beheer logica
    }
}
?>