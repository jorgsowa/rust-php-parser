===source===
<?php
class C {
    const A = 1;
    const B = 2, A = 3;
    const a = 4;
}
enum E {
    case X;
    const X = 1;
}
===errors===
Cannot redefine class constant C::A
Cannot redefine class constant E::X
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 7
===php_error >=8.1===
PHP Fatal error:  Cannot redefine class constant C::A in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 43,
                      "end": 44
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 47,
                      "end": 48
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 37,
                "end": 56
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 50,
                      "end": 51
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 54,
                      "end": 55
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 37,
                "end": 56
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 67,
                      "end": 68
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 71,
                      "end": 72
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 61,
                "end": 73
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 75
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 81,
              "end": 82
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 94,
                      "end": 95
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 89,
                "end": 96
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 107,
                      "end": 108
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 111,
                      "end": 112
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 101,
                "end": 113
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 76,
        "end": 115
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115
  }
}
