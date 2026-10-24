===source===
<?php
enum E {
    public(set) const X = 1;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'asymmetric visibility' requires PHP 8.4 or higher
Cannot use the public(set) modifier on a class constant
===errors 8.1-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
Cannot use the public(set) modifier on a class constant
===errors >=8.4===
Cannot use the public(set) modifier on a class constant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 3
===php_error 8.2-8.3===
PHP Parse error:  syntax error, unexpected token ")", expecting amp in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use the public(set) modifier on a class constant in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 37,
                      "end": 38
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 41,
                      "end": 42
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
