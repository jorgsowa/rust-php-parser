===source===
<?php
const A = E::A->value;
const B = E::A?->value;
===errors 8.1===
'property fetch in constant expressions' requires PHP 8.2 or higher
'property fetch in constant expressions' requires PHP 8.2 or higher
===php_error <=8.1===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast 8.1===
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
                                "start": 16,
                                "end": 17
                              }
                            }
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 19,
                            "end": 20
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "value"
                    },
                    "span": {
                      "start": 22,
                      "end": 27
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 27
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 27
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 35,
                "end": 36
              }
            },
            "value": {
              "kind": {
                "NullsafePropertyAccess": {
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
                                "start": 39,
                                "end": 40
                              }
                            }
                          },
                          "span": {
                            "start": 39,
                            "end": 40
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 42,
                            "end": 43
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 39,
                      "end": 43
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "value"
                    },
                    "span": {
                      "start": 46,
                      "end": 51
                    }
                  }
                }
              },
              "span": {
                "start": 39,
                "end": 51
              }
            },
            "attributes": [],
            "span": {
              "start": 35,
              "end": 51
            }
          }
        ]
      },
      "span": {
        "start": 29,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
