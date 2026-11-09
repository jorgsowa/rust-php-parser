===source===
<?php
class A {
    var var $f;
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
                    "name": "f",
                    "span": {
                      "start": 28,
                      "end": 30
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_var": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "var"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 24,
                          "end": 27
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 27
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 30
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
