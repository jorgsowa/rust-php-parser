===source===
<?php

namespace {
    use Ns\C;
}

namespace Ns {
    use C;
}

namespace {
    use C;
}

namespace Ns {
    use Ns\C;
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
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "C"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 27,
                            "end": 31
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 27,
                          "end": 31
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 23,
                  "end": 32
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 7,
        "end": 34
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
              "start": 46,
              "end": 48
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 59,
                            "end": 60
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 59,
                          "end": 60
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 55,
                  "end": 61
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 36,
        "end": 63
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
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 85,
                            "end": 86
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 85,
                          "end": 86
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 81,
                  "end": 87
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 65,
        "end": 89
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
              "start": 101,
              "end": 103
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "C"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 114,
                            "end": 118
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 114,
                          "end": 118
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 110,
                  "end": 119
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 91,
        "end": 121
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 121
  }
}
