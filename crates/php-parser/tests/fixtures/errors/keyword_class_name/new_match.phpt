===source===
<?php
new match;
===errors >=8.0===
expected class name, found 'match'
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "match" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "match", expecting "class" in Standard input code on line 2
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
                      "match"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 15
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
