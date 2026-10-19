===config===
min_php=8.5
===source===
<?php

class Bar {
    private function __invoke() {
        return __CLASS__;
    }
}

$b = new Bar;
echo $b();

echo $b->__invoke();

?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Bar",
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
                "Method": {
                  "name": {
                    "name": "__invoke",
                    "span": {
                      "start": 40,
                      "end": 48
                    }
                  },
                  "visibility": "Private",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "MagicConst": "Class"
                          },
                          "span": {
                            "start": 68,
                            "end": 77
                          }
                        }
                      },
                      "span": {
                        "start": 61,
                        "end": 78
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 84
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 86
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 88,
                  "end": 90
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Bar"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 97,
                            "end": 100
                          }
                        }
                      },
                      "span": {
                        "start": 97,
                        "end": 100
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 93,
                  "end": 100
                }
              }
            }
          },
          "span": {
            "start": 88,
            "end": 100
          }
        }
      },
      "span": {
        "start": 88,
        "end": 101
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "FunctionCall": {
                "name": {
                  "kind": {
                    "Variable": "b"
                  },
                  "span": {
                    "start": 107,
                    "end": 109
                  }
                },
                "args": []
              }
            },
            "span": {
              "start": 107,
              "end": 111
            }
          }
        ]
      },
      "span": {
        "start": 102,
        "end": 112
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "MethodCall": {
                "object": {
                  "kind": {
                    "Variable": "b"
                  },
                  "span": {
                    "start": 119,
                    "end": 121
                  }
                },
                "method": {
                  "kind": {
                    "Identifier": "__invoke"
                  },
                  "span": {
                    "start": 123,
                    "end": 131
                  }
                },
                "args": []
              }
            },
            "span": {
              "start": 119,
              "end": 133
            }
          }
        ]
      },
      "span": {
        "start": 114,
        "end": 134
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 134
  }
}
