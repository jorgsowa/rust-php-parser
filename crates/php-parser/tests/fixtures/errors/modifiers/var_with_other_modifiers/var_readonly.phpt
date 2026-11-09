===source===
<?php
class A {
    var readonly int $b;
}
===errors <=8.0===
expected variable, found 'readonly'
'readonly properties' requires PHP 8.1 or higher
===errors >=8.1===
expected variable, found 'readonly'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'int' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 3
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting variable in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 37,
                      "end": 39
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true,
                    "is_var": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 33,
                          "end": 36
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 36
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
