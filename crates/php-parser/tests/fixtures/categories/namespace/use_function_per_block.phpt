===source===
<?php

namespace {
    use function Ns\f;
}

namespace Ns {
    use function f;
}

namespace {
    use function f;
}

namespace Ns {
    use function Ns\f;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "f"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 36,
                            "end": 40
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 36,
                          "end": 40
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 23,
                  "end": 41
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 7,
        "end": 43
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Ns"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 55,
              "end": 57
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 77,
                            "end": 78
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 77,
                          "end": 78
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 64,
                  "end": 79
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 45,
        "end": 81
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 112,
                            "end": 113
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 112,
                          "end": 113
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 99,
                  "end": 114
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 83,
        "end": 116
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Ns"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 128,
              "end": 130
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "f"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 150,
                            "end": 154
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 150,
                          "end": 154
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 137,
                  "end": 155
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 118,
        "end": 157
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 157
  }
}
