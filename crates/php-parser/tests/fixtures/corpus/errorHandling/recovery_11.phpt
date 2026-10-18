===source===
<?php
new T
===errors===
expected ';' after expression
===php_error===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "T"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 11
  }
}
