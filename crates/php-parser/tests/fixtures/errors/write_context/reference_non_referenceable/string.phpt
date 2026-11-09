===source===
<?php
$a = &"s";
===errors===
Cannot assign reference to non referenceable value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token ";", expecting "->" or "?->" or "{" or "[" in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token ";", expecting "->" or "?->" or "[" in Standard input code on line 2
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "s"
                },
                "span": {
                  "start": 12,
                  "end": 15
                }
              },
              "by_ref": true
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
