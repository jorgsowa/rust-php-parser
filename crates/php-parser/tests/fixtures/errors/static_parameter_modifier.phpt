===description===
PHP rejects `static` as a parameter modifier with
"Cannot use the static modifier on a parameter". Replaces the
generic "expected variable, found identifier" diagnostic that the
parser previously emitted when encountering `static` in this position.
===source===
<?php
class A {
    public function __construct(public static int $x) {}
}
===errors >=8.5===
Cannot use the static modifier on a parameter
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected token "static", expecting variable in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use the static modifier on a parameter in Standard input code on line 3
===ast >=8.5===
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 66,
                          "end": 68
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 62,
                              "end": 65
                            }
                          }
                        },
                        "span": {
                          "start": 62,
                          "end": 65
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 68
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 72
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 74
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 74
  }
}
