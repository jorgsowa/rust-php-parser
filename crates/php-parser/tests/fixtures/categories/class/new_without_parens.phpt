===source===
<?php $obj = new Foo; $bar = new Bar\Baz;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 6,
                  "end": 10
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
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 17,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 20
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 13,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "bar"
                },
                "span": {
                  "start": 22,
                  "end": 26
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
                            "Bar",
                            "Baz"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 33,
                            "end": 40
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 40
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 29,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 40
          }
        }
      },
      "span": {
        "start": 22,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
