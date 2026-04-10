===source===
<?php

class Test {
    public A&B $prop;
}

function test(A&B $a): A&B {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
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
                "Property": {
                  "name": "prop",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Intersection": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 31,
                                "end": 32
                              }
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 32
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 33,
                                "end": 34
                              }
                            }
                          },
                          "span": {
                            "start": 33,
                            "end": 34
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 31,
                      "end": 34
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 40
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 43
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test",
          "params": [
            {
              "name": "a",
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 59,
                            "end": 60
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 60
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "B"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 61,
                            "end": 62
                          }
                        }
                      },
                      "span": {
                        "start": 61,
                        "end": 62
                      }
                    }
                  ]
                },
                "span": {
                  "start": 59,
                  "end": 62
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 59,
                "end": 65
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 68,
                        "end": 69
                      }
                    }
                  },
                  "span": {
                    "start": 68,
                    "end": 69
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 70,
                        "end": 71
                      }
                    }
                  },
                  "span": {
                    "start": 70,
                    "end": 71
                  }
                }
              ]
            },
            "span": {
              "start": 68,
              "end": 71
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 45,
        "end": 74
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 74
  }
}
