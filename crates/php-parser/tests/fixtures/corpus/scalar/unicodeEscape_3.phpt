===config===
php_rejects=semantic
===source===
<?php
"\u{FFFFFFFFFFFFFFFF}";
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