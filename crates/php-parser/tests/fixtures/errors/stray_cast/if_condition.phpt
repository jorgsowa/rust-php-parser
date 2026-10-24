===source===
<?php
if (int) {}
===errors===
unexpected token "(int)"
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(int)' (int) (T_INT_CAST), expecting '(' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "(int)", expecting "(" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Name": {
                "parts": [
                  "int"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 13
                }
              }
            },
            "span": {
              "start": 10,
              "end": 13
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
