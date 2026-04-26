===source===
<?php

class Foo {
    const A = 1;
    public const B = 2;
    protected const C = 3;
    private const D = 4;
    final const E = 5;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "A",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 33,
                      "end": 34
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 35
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "B",
                  "visibility": "Public",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 57,
                      "end": 58
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 40,
                "end": 59
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "C",
                  "visibility": "Protected",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 84,
                      "end": 85
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 64,
                "end": 86
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "D",
                  "visibility": "Private",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 109,
                      "end": 110
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 91,
                "end": 111
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "E",
                  "visibility": null,
                  "is_final": true,
                  "value": {
                    "kind": {
                      "Int": 5
                    },
                    "span": {
                      "start": 132,
                      "end": 133
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 116,
                "end": 134
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 136
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 136
  }
}
