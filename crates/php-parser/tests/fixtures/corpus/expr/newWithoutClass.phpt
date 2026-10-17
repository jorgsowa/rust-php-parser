===config===
min_php=8.3
===source===
<?php
new;
===errors===
expected identifier, found ';'
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "class" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": "Error",
                "span": {
                  "start": 9,
                  "end": 10
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
        "end": 10
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 10
  }
}
