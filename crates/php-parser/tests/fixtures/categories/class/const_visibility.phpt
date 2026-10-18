===source===
<?php class Foo { public const A = 1; protected const B = 2; private const C = 3; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 31,
                      "end": 32
                    }
                  },
                  "visibility": "Public",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 37
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 54,
                      "end": 55
                    }
                  },
                  "visibility": "Protected",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 58,
                      "end": 59
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 38,
                "end": 60
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 75,
                      "end": 76
                    }
                  },
                  "visibility": "Private",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 79,
                      "end": 80
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 61,
                "end": 81
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 83
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 83
  }
}
