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
          "name": {
            "name": "Foo",
            "span": {
              "start": 13,
              "end": 16
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
                      "start": 29,
                      "end": 30
                    }
                  },
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
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 53,
                      "end": 54
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 80,
                      "end": 81
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
                  },
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
                  "name": {
                    "name": "D",
                    "span": {
                      "start": 105,
                      "end": 106
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
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
                  "name": {
                    "name": "E",
                    "span": {
                      "start": 128,
                      "end": 129
                    }
                  },
                  "modifiers": {
                    "is_final": true
                  },
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
