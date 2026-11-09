===source===
<?php
interface I {
    private const B = 1, C = 2;
}
===errors===
Access type for interface constant I::B must be public
===php_error===
PHP Fatal error:  Access type for interface constant I::B must be public in Standard input code on line 3
===ast===
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
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 38,
                      "end": 39
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 43
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 45,
                      "end": 46
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 49,
                      "end": 50
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 45,
                "end": 51
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
