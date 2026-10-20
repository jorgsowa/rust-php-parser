===description===
Enum methods are redeclared case-insensitively like class methods; the message keeps the later spelling.
===source===
<?php
enum E {
    case A;
    public function f() {}
    public function F() {}
}
===errors===
Cannot redeclare E::F()
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot redeclare E::F() in Standard input code on line 5
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
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 24,
                      "end": 25
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 26
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 47,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 53
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "F",
                    "span": {
                      "start": 74,
                      "end": 75
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 58,
                "end": 80
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
