<?php
// Array of banned words
$banned_words = [
    "Abusive", "Aggressive", "Alcohol", "Arrogant", "Assault", "Attitude", "Badass", "Bastard", "Bitch", "Blackmail", 
    "Bloody", "Bullshit", "Burden", "Cunt", "Damn", "Defame", "Degrade", "Demoralize", "Denounce", "Depress", 
    "Destructive", "Detrimental", "Disgust", "Disrespect", "Dominate", "Drunk", "Dumb", "Envy", "Evil", "Exploit", 
    "Expose", "Failure", "Fake", "Filthy", "Foul", "Fraud", "Fuck", "Harassment", "Hate", "Homophobic", "Hostile", 
    "Hound", "Hurtful", "Hypocrite", "Insult", "Intimidate", "Jealous", "Kill", "Liar", "Lie", "Manipulate", 
    "Mental", "Mislead", "Narcissistic", "Neglect", "Offensive", "Oppressive", "Painful", "Pedophile", "Pervert", 
    "Psychotic", "Racist", "Rape", "Revenge", "Ridicule", "Rude", "Sadistic", "Satanic", "Scum", "Selfish", "Slut", 
    "Smear", "Stupid", "Suck", "Thief", "Threat", "Torture", "Traitor", "Tyrant", "Useless", "Violence", "Violent", 
    "Warlord", "Weirdo", "Wicked", "Wretched", "Yell", "Zealot", "Zombify", "Alcoholism", "Adultery", "Aggression", 
    "Amoral", "Anarchy", "Anxious", "Baiting", "Betrayal", "Bias", "Blackmailing", "Bother", "Bully", "Bunk", 
    "Cheating", "Clown", "Corrupt", "Crude", "Criminal", "Cunning", "Curvature", "Despise", "Disorder", "Disgrace", 
    "Diss", "Dread", "Dumbass", "Elitist", "Embarrassment", "Endanger", "Evilness", "Exile", "Expose", "Falsify", 
    "Fidgety", "Flake", "Fornicate", "Fraudulent", "Grotesque", "Hatecrime", "Hypocritical", "Insecure", "Insensitive", 
    "Insincerity", "Intolerance", "Manipulative", "Misfit", "Mock", "Murderous", "Narcissism", "Noose", "Obscene", 
    "Offend", "Overpower", "Perjury", "Phobia", "Pitiful", "Pretentious", "Pressure", "Repulsive", "Reprehensible", 
    "Rubbish", "Ruthless", "Scandalous", "Slander", "Slur", "Stab", "Stupidly", "Stymie", "Subjugate", "Swindle", 
    "Tolerate", "Traumatize", "Unfair", "Unjust", "Untrustworthy", "Vicious", "Violator", "Villain", "Wagering", 
    "Wasting", "Wounded", "Xenophobia", "Aggression", "Attack", "Backstabber", "Blacklisting", "Clueless", "Cruelty", 
    "Disapprove", "Exclusion", "Fraudulence", "Hysteria", "Impose", "Inferiority", "Malign", "Mistreat", "Negligence", 
    "Oppression", "Quarrel", "Slanderous", "Subordinate", "Torture", "Trafficking", "Undermine", "Unreliable", "Violent", 
    "Yoke", "Zinger", "Wagering", "Wrongdoer", "Yell", "Ugly", "Bitch", "Cunt", "Pussy", "Motherfucker", "Fucker", "Gay", "Badass"
];

// Connect to MySQL Database
$mysqli = new mysqli("localhost", "root", "", "censor_db");

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Insert the banned words into the database
foreach ($banned_words as $word) {
    $stmt = $mysqli->prepare("INSERT INTO banned_words (word) VALUES (?)");
    $stmt->bind_param("s", $word);
    $stmt->execute();
}

echo "200 banned words have been successfully added to the database!";

// Close connection
$mysqli->close();
?>
