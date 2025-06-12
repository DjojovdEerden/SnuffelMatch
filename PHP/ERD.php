<?php  // Opent het PHP script

// Profiel class definitie
class Profiel {  // Maakt een nieuwe class aan genaamd Profiel
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public string $bio;    // Maakt een publieke variabele aan voor de biografie (moet tekst zijn)
    public string $foto;   // Maakt een publieke variabele aan voor de foto (moet tekst zijn)
    public string $voorkeuren;  // Maakt een publieke variabele aan voor voorkeuren (moet tekst zijn)

    // Functie om profiel te bewerken
    public function bewerken(string $bio, string $foto, string $voorkeuren): void {
        $this->bio = $bio;           // Stelt de bio in met de nieuwe waarde
        $this->foto = $foto;         // Stelt de foto in met de nieuwe waarde
        $this->voorkeuren = $voorkeuren;  // Stelt de voorkeuren in met de nieuwe waarde
    }
}

// Gebruiker class definitie
class Gebruiker {  // Maakt een nieuwe class aan genaamd Gebruiker
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public string $naam;   // Maakt een publieke variabele aan voor de naam (moet tekst zijn)
    public string $email;  // Maakt een publieke variabele aan voor het email (moet tekst zijn)
    public string $wachtwoord;  // Maakt een publieke variabele aan voor het wachtwoord (moet tekst zijn)
    public Profiel $profiel;  // Maakt een publieke variabele aan voor het profiel (moet een Profiel object zijn)

    public function registreren(): void {  // Functie voor registratie (geeft niets terug)
        // Registratie logica
    }

    public function inloggen(string $email, string $wachtwoord): bool {  // Functie voor inloggen (geeft true/false terug)
        // Inlog logica
        return true;  // Geeft altijd true terug (placeholder)
    }

    public function uitloggen(): void {  // Functie voor uitloggen (geeft niets terug)
        // Uitlog logica
    }
}

// Asiel class definitie
class Asiel {  // Maakt een nieuwe class aan genaamd Asiel
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public string $naam;   // Maakt een publieke variabele aan voor de naam (moet tekst zijn)
    public string $locatie;  // Maakt een publieke variabele aan voor de locatie (moet tekst zijn)
    public string $contactgegevens;  // Maakt een publieke variabele aan voor contactgegevens (moet tekst zijn)
    /** @var Dier[] */     // Documentatie die aangeeft dat dit een array van Dier objecten is
    public array $dieren = [];  // Maakt een publieke array variabele aan voor dieren (begint leeg)

    public function dierToevoegen(Dier $dier): void {  // Functie om een dier toe te voegen
        $this->dieren[] = $dier;  // Voegt het dier toe aan het einde van de dieren array
    }

    public function dierVerwijderen(Dier $dier): void {  // Functie om een dier te verwijderen
        // Verwijder dier uit $this->dieren
    }
}

// Dier class definitie
class Dier {  // Maakt een nieuwe class aan genaamd Dier
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public string $naam;   // Maakt een publieke variabele aan voor de naam (moet tekst zijn)
    public string $soort;  // Maakt een publieke variabele aan voor de soort (moet tekst zijn)
    public string $ras;    // Maakt een publieke variabele aan voor het ras (moet tekst zijn)
    public int $leeftijd;  // Maakt een publieke variabele aan voor de leeftijd (moet een geheel getal zijn)
    public Asiel $asiel;   // Maakt een publieke variabele aan voor het asiel (moet een Asiel object zijn)
    public string $beschrijving;  // Maakt een publieke variabele aan voor de beschrijving (moet tekst zijn)

    public function toevoegen(): void {  // Functie om een dier toe te voegen
        // Toevoegen logica
    }

    public function bewerken(string $naam, string $soort, string $ras, int $leeftijd, string $beschrijving): void {
        $this->naam = $naam;           // Stelt de naam in
        $this->soort = $soort;         // Stelt de soort in
        $this->ras = $ras;             // Stelt het ras in
        $this->leeftijd = $leeftijd;   // Stelt de leeftijd in
        $this->beschrijving = $beschrijving;  // Stelt de beschrijving in
    }
}

// Swipe class definitie
class Swipe {  // Maakt een nieuwe class aan genaamd Swipe
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public Gebruiker $gebruiker;  // Maakt een publieke variabele aan voor de gebruiker (moet een Gebruiker object zijn)
    public Dier $dier;     // Maakt een publieke variabele aan voor het dier (moet een Dier object zijn)
    public string $richting;  // Maakt een publieke variabele aan voor de richting (moet tekst zijn)

    public function toevoegenSwipe(Gebruiker $gebruiker, Dier $dier, string $richting): void {
        // Swipe logica
    }
}

// MatchResult class definitie
class MatchResult {  // Maakt een nieuwe class aan genaamd MatchResult
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public Gebruiker $gebruiker;  // Maakt een publieke variabele aan voor de gebruiker (moet een Gebruiker object zijn)
    public Dier $dier;     // Maakt een publieke variabele aan voor het dier (moet een Dier object zijn)

    public function controlerenMatch(Gebruiker $gebruiker, Dier $dier): bool {
        return true;  // Geeft altijd true terug (placeholder)
    }
}

// Bericht class definitie
class Bericht {  // Maakt een nieuwe class aan genaamd Bericht
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public Gebruiker $afzender;  // Maakt een publieke variabele aan voor de afzender (moet een Gebruiker object zijn)
    public Asiel $ontvanger;  // Maakt een publieke variabele aan voor de ontvanger (moet een Asiel object zijn)
    public string $inhoud;  // Maakt een publieke variabele aan voor de inhoud (moet tekst zijn)
    public DateTime $verzendTijd;  // Maakt een publieke variabele aan voor de verzendtijd (moet een DateTime object zijn)

    public function verzenden(): void {  // Functie om een bericht te verzenden
        // Verzend logica
    }

    /** @return Bericht[] */  // Documentatie die aangeeft dat deze functie een array van Bericht objecten teruggeeft
    public function ontvangen(): array {  // Functie om berichten te ontvangen
        return [];  // Geeft een lege array terug (placeholder)
    }
}

// Favoriet class definitie
class Favoriet {  // Maakt een nieuwe class aan genaamd Favoriet
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public Gebruiker $gebruiker;  // Maakt een publieke variabele aan voor de gebruiker (moet een Gebruiker object zijn)
    public Dier $dier;     // Maakt een publieke variabele aan voor het dier (moet een Dier object zijn)
    public DateTime $datumToegevoegd;  // Maakt een publieke variabele aan voor de toevoegdatum (moet een DateTime object zijn)

    public function toevoegenFavoriet(Gebruiker $gebruiker, Dier $dier): void {
        // Favoriet toevoegen logica
    }

    public function verwijderenFavoriet(Gebruiker $gebruiker, Dier $dier): void {
        // Favoriet verwijderen logica
    }
}

// FilterSysteem class definitie
class FilterSysteem {  // Maakt een nieuwe class aan genaamd FilterSysteem
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public Gebruiker $gebruiker;  // Maakt een publieke variabele aan voor de gebruiker (moet een Gebruiker object zijn)
    public string $soort;  // Maakt een publieke variabele aan voor de soort (moet tekst zijn)
    public string $ras;    // Maakt een publieke variabele aan voor het ras (moet tekst zijn)
    public int $minLeeftijd;  // Maakt een publieke variabele aan voor minimum leeftijd (moet een geheel getal zijn)
    public int $maxLeeftijd;  // Maakt een publieke variabele aan voor maximum leeftijd (moet een geheel getal zijn)

    public function toepassenFilter(Gebruiker $gebruiker, string $soort, string $ras, int $minLeeftijd, int $maxLeeftijd): array {
        return [];  // Geeft een lege array terug (placeholder)
    }
}

// AdoptieAanvraag class definitie
class AdoptieAanvraag {  // Maakt een nieuwe class aan genaamd AdoptieAanvraag
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public Gebruiker $aanvrager;  // Maakt een publieke variabele aan voor de aanvrager (moet een Gebruiker object zijn)
    public Dier $dier;     // Maakt een publieke variabele aan voor het dier (moet een Dier object zijn)
    public string $status;  // Maakt een publieke variabele aan voor de status (moet tekst zijn)
    public DateTime $datumAanvraag;  // Maakt een publieke variabele aan voor de aanvraagdatum (moet een DateTime object zijn)

    public function indienenAanvraag(Gebruiker $aanvrager, Dier $dier): void {
        // Aanvraag logica
    }

    public function wijzigStatus(string $status): void {
        $this->status = $status;  // Stelt de status in met de nieuwe waarde
    }
}

// Review class definitie
class Review {  // Maakt een nieuwe class aan genaamd Review
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public Gebruiker $gebruiker;  // Maakt een publieke variabele aan voor de gebruiker (moet een Gebruiker object zijn)
    public Asiel $asiel;   // Maakt een publieke variabele aan voor het asiel (moet een Asiel object zijn)
    public int $beoordeling;  // Maakt een publieke variabele aan voor de beoordeling (moet een geheel getal zijn)
    public string $opmerking;  // Maakt een publieke variabele aan voor de opmerking (moet tekst zijn)
    public DateTime $datum;  // Maakt een publieke variabele aan voor de datum (moet een DateTime object zijn)

    public function toevoegenReview(Gebruiker $gebruiker, Asiel $asiel, int $beoordeling, string $opmerking): void {
        // Review logica
    }
}

// Notificatie class definitie
class Notificatie {  // Maakt een nieuwe class aan genaamd Notificatie
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public Gebruiker $ontvanger;  // Maakt een publieke variabele aan voor de ontvanger (moet een Gebruiker object zijn)
    public string $bericht;  // Maakt een publieke variabele aan voor het bericht (moet tekst zijn)
    public bool $gelezen = false;  // Maakt een publieke variabele aan voor gelezen status (standaard false)
    public DateTime $verzendTijd;  // Maakt een publieke variabele aan voor de verzendtijd (moet een DateTime object zijn)

    public function verzendenNotificatie(Gebruiker $ontvanger, string $bericht): void {
        // Notificatie logica
    }

    public function markeerAlsGelezen(): void {
        $this->gelezen = true;  // Zet de gelezen status op true
    }
}

// BezoekAfspraak class definitie
class BezoekAfspraak {  // Maakt een nieuwe class aan genaamd BezoekAfspraak
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public Gebruiker $gebruiker;  // Maakt een publieke variabele aan voor de gebruiker (moet een Gebruiker object zijn)
    public Dier $dier;     // Maakt een publieke variabele aan voor het dier (moet een Dier object zijn)
    public Asiel $asiel;   // Maakt een publieke variabele aan voor het asiel (moet een Asiel object zijn)
    public DateTime $afspraakTijd;  // Maakt een publieke variabele aan voor de afspraaktijd (moet een DateTime object zijn)
    public string $status;  // Maakt een publieke variabele aan voor de status (moet tekst zijn)

    public function plannenAfspraak(Gebruiker $gebruiker, Dier $dier, Asiel $asiel, DateTime $afspraakTijd): void {
        // Afspraak logica
    }

    public function wijzigStatus(string $status): void {
        $this->status = $status;  // Stelt de status in met de nieuwe waarde
    }
}

// Admin class definitie
class Admin {  // Maakt een nieuwe class aan genaamd Admin
    public int $id;        // Maakt een publieke variabele aan voor het ID (moet een geheel getal zijn)
    public string $naam;   // Maakt een publieke variabele aan voor de naam (moet tekst zijn)
    public string $email;  // Maakt een publieke variabele aan voor het email (moet tekst zijn)
    public string $wachtwoord;  // Maakt een publieke variabele aan voor het wachtwoord (moet tekst zijn)

    public function inloggen(string $email, string $wachtwoord): bool {
        return true;  // Geeft altijd true terug (placeholder)
    }

    public function beheerActie(string $actie): void {
        // Beheer logica
    }
}
?>