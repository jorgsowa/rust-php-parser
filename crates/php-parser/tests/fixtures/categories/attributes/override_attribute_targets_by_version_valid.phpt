===source===
<?php
class P {
    function m() {}
}
class C extends P {
    #[\Override] function m() {}
}
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "P",
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 35
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 44,
              "end": 45
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "P"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 54,
              "end": 55
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 38,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "P",
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 35
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 44,
              "end": 45
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "P"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 54,
              "end": 55
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 84,
                      "end": 85
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Override"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 64,
                          "end": 73
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 64,
                        "end": 73
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 62,
                "end": 90
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 38,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
