===source===
<?php enum Status: string { case Active = 'a'; const DEFAULT = self::Active; const SUM = 1 + 2; }
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 19,
              "end": 25
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Active",
                    "span": {
                      "start": 33,
                      "end": 39
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 42,
                      "end": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 28,
                "end": 46
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "DEFAULT",
                    "span": {
                      "start": 53,
                      "end": 60
                    }
                  },
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 63,
                                "end": 67
                              }
                            }
                          },
                          "span": {
                            "start": 63,
                            "end": 67
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "Active"
                          },
                          "span": {
                            "start": 69,
                            "end": 75
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 63,
                      "end": 75
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 76
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "SUM",
                    "span": {
                      "start": 83,
                      "end": 86
                    }
                  },
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 89,
                            "end": 90
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 93,
                            "end": 94
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 89,
                      "end": 94
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 77,
                "end": 95
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 97
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 97
  }
}
