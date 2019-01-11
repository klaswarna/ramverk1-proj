USE grammatikgruvan;


INSERT INTO `anvandare` (`anvandarnamn`, `losenord`, `email`) VALUES
    ("Olle", "264fcf838c8e4b9d17c510cd5b8b9b78", "olle@olle.net"),
    ("Pelle", "5574331fd0ffcb0a268e59f8c5a0cc5d", "pelle@pelle.net"),
    ("Kalle", "c16e24898200c27d89cd30e9abd51984", "kalle@kalle.net"),
    ("Lisa", "ed14f4a4d7ecddb6dae8e54900300b1e", "lisa@lisa.net");


-- fråga med id 1
INSERT INTO `inlagg` (`title`, `data`, `type`, `slug`, `rankning`, `userid`) VALUES
    ("Vad är ett substantiv", "Jag har alltid undrat vad ett substantiv är. Någon som vet?", "fraga", "vad-ar-ett-substantiv", 5, 1);


-- svar på fråga 1 med id 2 resp 3
INSERT INTO `inlagg` (`data`, `type`, `rankning`, `userid`, `tillhor`) VALUES
    ("Det är namn på ting", "svar", 2, 2, 1),
    ("Allt man kan skriva -jävel efter. Tex. gubbjävel", "svar", 3, 3, 1);


-- kommentarer. 1 till svar med id2, två till svar med id3
INSERT INTO `inlagg` (`data`, `type`, `userid`, `tillhor`) VALUES
    ("Korrekt beskrivning", "kommentar", 3, 2),
    ("Man ska inte svära", "kommentar", 3, 3);




-- fråga med id 7
INSERT INTO `inlagg` (`title`, `data`, `type`, `slug`, `rankning`, `userid`) VALUES
    ("Vad är ett adjektiv", "Jag har alltid undrat vad ett adjektiv är. Någon som vet?", "fraga", "vad-ar-ett-adjektiv", 5, 2);


-- svar på fråga 7 med id 8 resp 9
INSERT INTO `inlagg` (`data`, `type`, `rankning`, `userid`, `tillhor`) VALUES
    ("Det beskriver ting", "svar", 2, 1, 7),
    ("Allt man kan skriva skit framför. Tex. skitbra", "svar", 3, 3, 7);


-- kommentarer. 1 till svar med id8, två till svar med id9
INSERT INTO `inlagg` (`data`, `type`, `userid`, `tillhor`) VALUES
    ("Korrekt beskrivning, tro jag", "kommentar", 3, 8),
    ("Vilket onödigt inlägg om du inte är säker.", "kommentar", 3, 8);





INSERT INTO `taggar` (`tagg`) VALUES
    ("substantiv"),
    ("adjektiv"),
    ("ordklasser");



INSERT INTO `inlaggtagg` (`inlagg`,`tagg`) VALUES
    (1, 1),
    (1,3),
    (7,2),
    (7,3);
