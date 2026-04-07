===source===
<?php
[[$a, [$b, $c]], $d] = $data;
[[[$e, $f], $g], [$h, $i]] = $matrix;
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 8,
                                  "end": 10
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 8,
                                "end": 10
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "b"
                                        },
                                        "span": {
                                          "start": 13,
                                          "end": 15
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 13,
                                        "end": 15
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "c"
                                        },
                                        "span": {
                                          "start": 17,
                                          "end": 19
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 17,
                                        "end": 19
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 12,
                                  "end": 20
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 12,
                                "end": 20
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 7,
                          "end": 21
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 21
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "d"
                        },
                        "span": {
                          "start": 23,
                          "end": 25
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 23,
                        "end": 25
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 26
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "data"
                },
                "span": {
                  "start": 29,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "e"
                                        },
                                        "span": {
                                          "start": 39,
                                          "end": 41
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 39,
                                        "end": 41
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "f"
                                        },
                                        "span": {
                                          "start": 43,
                                          "end": 45
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 43,
                                        "end": 45
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 38,
                                  "end": 46
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 38,
                                "end": 46
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "g"
                                },
                                "span": {
                                  "start": 48,
                                  "end": 50
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 48,
                                "end": 50
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 37,
                          "end": 51
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 37,
                        "end": 51
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "h"
                                },
                                "span": {
                                  "start": 54,
                                  "end": 56
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 54,
                                "end": 56
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "i"
                                },
                                "span": {
                                  "start": 58,
                                  "end": 60
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 58,
                                "end": 60
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 53,
                          "end": 61
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 53,
                        "end": 61
                      }
                    }
                  ]
                },
                "span": {
                  "start": 36,
                  "end": 62
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "matrix"
                },
                "span": {
                  "start": 65,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 72
          }
        }
      },
      "span": {
        "start": 36,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
