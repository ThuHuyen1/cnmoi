rule Detect_Web_Shell {
    strings:
        $a1 = "system(" nocase
        $a2 = "$_GET" nocase
        $a3 = "$_POST" nocase
        $a4 = "$_REQUEST" nocase
        $b = "eval(" nocase
        $c = "shell_exec(" nocase
        $d = "passthru(" nocase
    condition:
        any of them
}
