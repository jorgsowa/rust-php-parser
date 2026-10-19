===source===
<?php
enum E {
    public function gen() { yield 1; }
    public function &ref(array &$a) { return $a; }
}
===ast===
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
                "Method": {
                  "name": {
                    "name": "gen",
                    "span": {
                      "start": 35,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Yield": {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 49,
                                  "end": 50
                                }
                              },
                              "is_from": false
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 50
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 51
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 53
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "ref",
                    "span": {
                      "start": 75,
                      "end": 78
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": true,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 86,
                          "end": 88
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 79,
                              "end": 84
                            }
                          }
                        },
                        "span": {
                          "start": 79,
                          "end": 84
                        }
                      },
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 79,
                        "end": 88
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 99,
                            "end": 101
                          }
                        }
                      },
                      "span": {
                        "start": 92,
                        "end": 102
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 58,
                "end": 104
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 106
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 106
  }
}
