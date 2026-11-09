===source===
<?php
class A {
    static var $d;
}
===errors===
expected variable, found identifier
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'var' (T_VAR), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "var", expecting variable in Standard input code on line 3
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
                    "name": "d",
                    "span": {
                      "start": 31,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "var"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 30
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 30
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 33
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
