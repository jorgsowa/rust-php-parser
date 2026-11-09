===source===
<?php
class C {
    public $a, $b,;
}
===errors===
expected variable, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting variable in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "a",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 29
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 31,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 33
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
