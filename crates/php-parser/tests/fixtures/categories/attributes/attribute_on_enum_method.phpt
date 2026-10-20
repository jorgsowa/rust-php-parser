===source===
<?php enum E { case A; #[Override] public function foo(): void {} }
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 1
===ast >=8.1===
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
                      "start": 20,
                      "end": 21
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 15,
                "end": 22
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "foo",
                    "span": {
                      "start": 51,
                      "end": 54
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
                          "start": 58,
                          "end": 62
                        }
                      }
                    },
                    "span": {
                      "start": 58,
                      "end": 62
                    }
                  },
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Override"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 25,
                          "end": 33
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 25,
                        "end": 33
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 35,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
