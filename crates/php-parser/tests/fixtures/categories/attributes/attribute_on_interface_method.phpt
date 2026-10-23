===source===
<?php interface I { #[Pure] public function foo(): void; }
===errors <=7.4===
missing closing '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 1
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "foo",
                    "span": {
                      "start": 44,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 51,
                          "end": 55
                        }
                      }
                    },
                    "span": {
                      "start": 51,
                      "end": 55
                    }
                  },
                  "body": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Pure"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 26
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 26
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
