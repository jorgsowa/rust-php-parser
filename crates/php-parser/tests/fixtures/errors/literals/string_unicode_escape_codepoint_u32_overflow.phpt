===source===
<?php "\u{FFFFFFFFFFFFFFFF}";
===errors===
Invalid UTF-8 codepoint escape sequence: Codepoint too large
===php_error===
PHP Parse error:  Invalid UTF-8 codepoint escape sequence: Codepoint too large in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": []
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
