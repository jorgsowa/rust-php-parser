===source===
<?php enum Suit: string implements \Stringable { case Hearts = 'H'; public function __toString(): string { return $this->value; } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Suit",
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 17,
              "end": 24
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
                "end": 47
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Hearts",
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
                "end": 68
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "__toString",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                        "end": 128
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 68,
                "end": 130
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
