===source===
<?php enum Color { case Red; public static function default(): self { return self::Red; } }
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Color" in Standard input code on line 1
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Color",
            "span": {
              "start": 11,
              "end": 16
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Red",
                    "span": {
                      "start": 24,
                      "end": 27
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 28
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "default",
                    "span": {
                      "start": 52,
                      "end": 59
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
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
                  "body": [
                    {
                      "kind": {
                        "Return": {
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
                                      "start": 77,
                                      "end": 81
                                    }
                                  }
                                },
                                "span": {
                                  "start": 77,
                                  "end": 81
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "Red"
                                },
                                "span": {
                                  "start": 83,
                                  "end": 86
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 77,
                            "end": 86
                          }
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 87
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 89
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}
