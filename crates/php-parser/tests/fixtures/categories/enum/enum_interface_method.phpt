===config===
min_php=8.1
===source===
<?php enum Suit: string implements \Stringable { case Hearts = 'H'; public function __toString(): string { return $this->value; } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Suit",
            "span": {
              "start": 11,
              "end": 15
            }
          },
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 17,
              "end": 23
            }
          },
          "implements": [
            {
              "parts": [
                "Stringable"
              ],
              "kind": "FullyQualified",
              "span": {
                "start": 35,
                "end": 46
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Hearts",
                    "span": {
                      "start": 54,
                      "end": 60
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "H"
                    },
                    "span": {
                      "start": 63,
                      "end": 66
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 49,
                "end": 67
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__toString",
                    "span": {
                      "start": 84,
                      "end": 94
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
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 98,
                          "end": 104
                        }
                      }
                    },
                    "span": {
                      "start": 98,
                      "end": 104
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 114,
                                  "end": 119
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "value"
                                },
                                "span": {
                                  "start": 121,
                                  "end": 126
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 114,
                            "end": 126
                          }
                        }
                      },
                      "span": {
                        "start": 107,
                        "end": 127
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 68,
                "end": 129
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 131
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 131
  }
}
