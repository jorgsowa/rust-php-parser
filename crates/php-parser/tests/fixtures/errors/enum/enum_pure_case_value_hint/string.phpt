===source===
<?php
enum A { case X = "x"; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Case X of non-backed enum A must not have a value
===errors >=8.1===
Case X of non-backed enum A must not have a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'A' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "A" in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Case X of non-backed enum A must not have a value, try adding ": string" to the enum declaration in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Case X of non-backed enum A must not have a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "A",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 20,
                      "end": 21
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "x"
                    },
                    "span": {
                      "start": 24,
                      "end": 27
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 15,
                "end": 28
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
