===source===
<?php

function exit(string|int $status = 0): never {}

function die(string|int $status = 0): never {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "exit",
          "params": [
            {
              "name": "status",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 21,
                            "end": 27,
                            "start_line": 3,
                            "start_col": 14
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 27,
                        "start_line": 3,
                        "start_col": 14
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 28,
                            "end": 31,
                            "start_line": 3,
                            "start_col": 21
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 31,
                        "start_line": 3,
                        "start_col": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 21,
                  "end": 31,
                  "start_line": 3,
                  "start_col": 14
                }
              },
              "default": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 42,
                  "end": 43,
                  "start_line": 3,
                  "start_col": 35
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
                "start": 21,
                "end": 43,
                "start_line": 3,
                "start_col": 14
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 46,
                  "end": 51,
                  "start_line": 3,
                  "start_col": 39
                }
              }
            },
            "span": {
              "start": 46,
              "end": 51,
              "start_line": 3,
              "start_col": 39
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 54,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "die",
          "params": [
            {
              "name": "status",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 69,
                            "end": 75,
                            "start_line": 5,
                            "start_col": 13
                          }
                        }
                      },
                      "span": {
                        "start": 69,
                        "end": 75,
                        "start_line": 5,
                        "start_col": 13
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 76,
                            "end": 79,
                            "start_line": 5,
                            "start_col": 20
                          }
                        }
                      },
                      "span": {
                        "start": 76,
                        "end": 79,
                        "start_line": 5,
                        "start_col": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 69,
                  "end": 79,
                  "start_line": 5,
                  "start_col": 13
                }
              },
              "default": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 90,
                  "end": 91,
                  "start_line": 5,
                  "start_col": 34
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
                "start": 69,
                "end": 91,
                "start_line": 5,
                "start_col": 13
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 94,
                  "end": 99,
                  "start_line": 5,
                  "start_col": 38
                }
              }
            },
            "span": {
              "start": 94,
              "end": 99,
              "start_line": 5,
              "start_col": 38
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 56,
        "end": 102,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102,
    "start_line": 1,
    "start_col": 0
  }
}
