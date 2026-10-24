===source===
<?php
class A {
    public int $x = true;
}
===errors <=7.4===
Default value for property of type int can only be int
===errors 8.0-8.2===
Cannot use bool as default value for property A::$x of type int
===errors >=8.3===
Cannot use true as default value for property A::$x of type int
===php_error <=7.4===
PHP Fatal error:  Default value for property of type int can only be int in Standard input code on line 3
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use bool as default value for property A::$x of type int in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use true as default value for property A::$x of type int in Standard input code on line 3
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
                    "name": "x",
                    "span": {
                      "start": 31,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
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
                  "default": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 36,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 40
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
