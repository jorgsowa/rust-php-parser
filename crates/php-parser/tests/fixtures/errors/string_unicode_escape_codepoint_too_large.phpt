===source===
<?php $s = "\u{999999}";
===errors===
Invalid UTF-8 codepoint escape sequence: Codepoint too large
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "s"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": []
                },
                "span": {
                  "start": 11,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
===php_error===
PHP Parse error:  Invalid UTF-8 codepoint escape sequence: Codepoint too large in Standard input code on line 1
