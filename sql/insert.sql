USE grammatikgruvan;


INSERT INTO `anvandare2` (`anvandarnamn`, `losenord`, `email`, `fraga`, `svar`, `kommentar`, `rfraga`, `rsvar`, `rkommentar`) VALUES
    ("Olle", "264fcf838c8e4b9d17c510cd5b8b9b78", "olle@olle.net",4 ,0 ,0, 0, 0, 0),
    ("Pelle", "5574331fd0ffcb0a268e59f8c5a0cc5d", "pelle@pelle.net",0 ,4 ,0, 0, 0, 0),
    ("Kalle", "c16e24898200c27d89cd30e9abd51984", "kalle@kalle.net",0 ,4 ,1, 0, 0, 0),
    ("Lisa", "ed14f4a4d7ecddb6dae8e54900300b1e", "lisa@lisa.net",0 ,0 ,3, 0, 0, 0);


-- fråga med id 1
INSERT INTO `inlagg` (`title`, `data`, `type`, `slug`, `rankning`, `userid`) VALUES
    ("Vad är ett substantiv", "Jag har alltid undrat vad ett substantiv är. Någon som vet?", "fraga", "vad-ar-ett-substantiv", 0, 1);


-- svar på fråga 1 med id 2 resp 3
INSERT INTO `inlagg` (`data`, `type`, `rankning`, `userid`, `tillhor`) VALUES
    ("Substantiv är namn på ting: såsom apa, boll och sting", "svar", 0, 2, 1),
    ("Allt man kan skriva -jävel efter. Tex. gubbjävel", "svar", 0, 3, 1);


-- kommentarer. 1 till svar med id2, två till svar med id3
INSERT INTO `inlagg` (`data`, `type`, `userid`, `tillhor`, `rankning`) VALUES
    ("Korrekt beskrivning", "kommentar", 4, 2, 0),
    ("Man ska inte svära", "kommentar", 4, 3, 0);




-- fråga med id 7
INSERT INTO `inlagg` (`title`, `data`, `type`, `slug`, `rankning`, `userid`) VALUES
    ("Vad är ett adjektiv", "Vad är ett adjektiv då?", "fraga", "vad-ar-ett-adjektiv", 0, 1);


-- svar på fråga 7 med id 8 resp 9
INSERT INTO `inlagg` (`data`, `type`, `rankning`, `userid`, `tillhor`) VALUES
    ("Adjektiven sen oss lär hurdana tingen är: glada, snälla, rara så som vi ska vara", "svar", 0, 2, 6),
    ("Allt man kan skriva skit framför. Tex. skitbra", "svar", 0, 3, 6);


-- kommentarer. 1 till svar med id8, två till svar med id9
INSERT INTO `inlagg` (`data`, `type`, `userid`, `tillhor`, `rankning`) VALUES
    ("Korrekt beskrivning, tro jag", "kommentar", 3, 8,0),
    ("Vilket onödigt inlägg om du inte är säker.", "kommentar", 4, 8,0);


INSERT INTO `inlagg` (`title`, `data`, `type`, `slug`, `rankning`, `userid`) VALUES
    ("Vad är ett verb", "Vad är verb nu igen?", "fraga", "vad-ar-ett-verb", 0, 1),
    ("Vad är ett räkneord", "Vad är räkneord?", "fraga", "vad-ar-ett-rakneord", 0, 1);


INSERT INTO `inlagg` (`data`, `type`, `rankning`, `userid`, `tillhor`) VALUES
    ("Verb är sånt som man kan göra känna, kramas, se och röra", "svar", 0, 2, 11),
    ("Efter verb kan man skriva ...så in i helvete. T.ex. vi söp så in i helvete.", "svar", 0, 3, 11);


INSERT INTO `inlagg` (`data`, `type`, `rankning`, `userid`, `tillhor`) VALUES
    ("Räkneord som ett, två, tre det är nåt att räkna mé", "svar", 0, 2, 12),
    ("Tja. T.ex. tusan också, Fy sjutton!", "svar", 0, 3, 12);




INSERT INTO `taggar` (`tagg`) VALUES
    ("substantiv"),
    ("adjektiv"),
    ("ordklasser"),
    ("verb"),
    ("räkneord");



INSERT INTO `inlaggtagg` (`inlagg`,`tagg`) VALUES
    (1, 1),
    (1,3),
    (6,2),
    (6,3),
    (11,3),
    (11,4),
    (12,3),
    (12,5);
