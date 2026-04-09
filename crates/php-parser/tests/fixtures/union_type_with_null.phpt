===source===
<?php function foo(int|string|null $x): string|false { return ''; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "x",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 22,
                            "start_line": 1,
                            "start_col": 19
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 22,
                        "start_line": 1,
                        "start_col": 19
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 23,
                            "end": 29,
                            "start_line": 1,
                            "start_col": 23
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 29,
                        "start_line": 1,
                        "start_col": 23
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "null"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 30,
                            "end": 34,
                            "start_line": 1,
                            "start_col": 30
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 34,
                        "start_line": 1,
                        "start_col": 30
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 34,
                  "start_line": 1,
                  "start_col": 19
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
                "start": 19,
                "end": 37,
                "start_line": 1,
                "start_col": 19
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "String": ""
                  },
                  "span": {
                    "start": 62,
                    "end": 64,
                    "start_line": 1,
                    "start_col": 62
                  }
                }
              },
              "span": {
                "start": 55,
                "end": 66,
                "start_line": 1,
                "start_col": 55
              }
            }
          ],
          "return_type": {
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
                        "start": 40,
                        "end": 46,
                        "start_line": 1,
                        "start_col": 40
                      }
                    }
                  },
                  "span": {
                    "start": 40,
                    "end": 46,
                    "start_line": 1,
                    "start_col": 40
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "false"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 47,
                        "end": 52,
                        "start_line": 1,
                        "start_col": 47
                      }
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 52,
                    "start_line": 1,
                    "start_col": 47
                  }
                }
              ]
            },
            "span": {
              "start": 40,
              "end": 52,
              "start_line": 1,
              "start_col": 40
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67,
    "start_line": 1,
    "start_col": 0
  }
}
