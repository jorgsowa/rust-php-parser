===config===
min_php=8.5
===source===
<?php
const A = static function () {};
const B = strlen(...);
const C = (int) "1";
const D = E::A->value;
function f($a = new Foo) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Closure": {
                  "is_static": true,
                  "by_ref": false,
                  "params": [],
                  "use_vars": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 37
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 37
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 38
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 45,
                "end": 46
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "strlen"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 49,
                            "end": 55
                          }
                        }
                      },
                      "span": {
                        "start": 49,
                        "end": 55
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 49,
                "end": 60
              }
            },
            "attributes": [],
            "span": {
              "start": 45,
              "end": 60
            }
          }
        ]
      },
      "span": {
        "start": 39,
        "end": 61
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 68,
                "end": 69
              }
            },
            "value": {
              "kind": {
                "Cast": [
                  "Int",
                  {
                    "kind": {
                      "String": "1"
                    },
                    "span": {
                      "start": 78,
                      "end": 81
                    }
                  }
                ]
              },
              "span": {
                "start": 72,
                "end": 81
              }
            },
            "attributes": [],
            "span": {
              "start": 68,
              "end": 81
            }
          }
        ]
      },
      "span": {
        "start": 62,
        "end": 82
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 89,
                "end": 90
              }
            },
            "value": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "E"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 93,
                                "end": 94
                              }
                            }
                          },
                          "span": {
                            "start": 93,
                            "end": 94
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 96,
                            "end": 97
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 93,
                      "end": 97
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "value"
                    },
                    "span": {
                      "start": 99,
                      "end": 104
                    }
                  }
                }
              },
              "span": {
                "start": 93,
                "end": 104
              }
            },
            "attributes": [],
            "span": {
              "start": 89,
              "end": 104
            }
          }
        ]
      },
      "span": {
        "start": 83,
        "end": 105
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 115,
              "end": 116
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 117,
                  "end": 119
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 126,
                            "end": 129
                          }
                        }
                      },
                      "span": {
                        "start": 126,
                        "end": 129
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 122,
                  "end": 129
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 117,
                "end": 129
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 106,
        "end": 133
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133
  }
}
