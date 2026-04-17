===config===
max_php=8.2
===source===
<?php
new
===errors===
expected identifier, found end of file
expected ';' after expression
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
                  "Identifier": "<error>"
                },
                "span": {
                  "start": 9,
                  "end": 9
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 9
          }
        }
      },
      "span": {
        "start": 6,
        "end": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 9
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
