===source===
<?php
class A extends int {}
class B implements string, mixed {}
interface I extends object {}
enum E implements iterable {}
new class extends never {};
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 5
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 5
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
          "extends": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 25
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 35,
              "end": 36
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [
            {
              "parts": [
                "string"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 48,
                "end": 54
              }
            },
            {
              "parts": [
                "mixed"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 56,
                "end": 61
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 29,
        "end": 64
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 75,
              "end": 76
            }
          },
          "extends": [
            {
              "parts": [
                "object"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 85,
                "end": 91
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 65,
        "end": 94
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 100,
              "end": 101
            }
          },
          "scalar_type": null,
          "implements": [
            {
              "parts": [
                "iterable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 113,
                "end": 121
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 95,
        "end": 124
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
                    "name": null,
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "never"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 143,
                        "end": 148
                      }
                    },
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 125,
                  "end": 151
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 125,
            "end": 151
          }
        }
      },
      "span": {
        "start": 125,
        "end": 152
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 152
  }
}
