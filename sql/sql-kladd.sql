-- nedanstående gör en tabell som innehåller taggid tagg (namnet) samt inlagg (nr på vilket inlägg det tillhör)

SELECT taggid, taggar.tagg, inlagg FROM taggar JOIN inlaggtagg ON inlaggtagg.tagg = taggar.taggid;
