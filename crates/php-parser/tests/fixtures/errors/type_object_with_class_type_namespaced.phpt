===config===
min_php=8.0

===source===
<?php
namespace N;
use X\Y, X\Z as W;
function a(): object|A {}
function b(): Y|object {}
function c(): object|W\V {}
function d(): object|\G {}
function e(): object|namespace\H {}
===errors===
Type N\A|object contains both object and a class type, which is redundant
Type X\Y|object contains both object and a class type, which is redundant
Type X\Z\V|object contains both object and a class type, which is redundant
Type G|object contains both object and a class type, which is redundant
Type N\H|object contains both object and a class type, which is redundant
===php_error===
PHP Fatal error:  Type N\A|object contains both object and a class type, which is redundant in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "X",
                  "Y"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 23,
                  "end": 26
                }
              },
              "alias": null,
              "span": {
                "start": 23,
                "end": 26
              }
            },
            {
              "name": {
                "parts": [
                  "X",
                  "Z"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 28,
                  "end": 31
                }
              },
              "alias": {
                "name": "W",
                "span": {
                  "start": 35,
                  "end": 36
                }
              },
              "span": {
                "start": 28,
                "end": 36
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 37
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 47,
              "end": 48
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 52,
                        "end": 58
                      }
                    }
                  },
                  "span": {
                    "start": 52,
                    "end": 58
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 59,
                        "end": 60
                      }
                    }
                  },
                  "span": {
                    "start": 59,
                    "end": 60
                  }
                }
              ]
            },
            "span": {
              "start": 52,
              "end": 60
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 38,
        "end": 63
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 73,
              "end": 74
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Y"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 78,
                        "end": 79
                      }
                    }
                  },
                  "span": {
                    "start": 78,
                    "end": 79
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 80,
                        "end": 86
                      }
                    }
                  },
                  "span": {
                    "start": 80,
                    "end": 86
                  }
                }
              ]
            },
            "span": {
              "start": 78,
              "end": 86
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 64,
        "end": 89
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 99,
              "end": 100
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 104,
                        "end": 110
                      }
                    }
                  },
                  "span": {
                    "start": 104,
                    "end": 110
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "W",
                        "V"
                      ],
                      "kind": "Qualified",
                      "span": {
                        "start": 111,
                        "end": 114
                      }
                    }
                  },
                  "span": {
                    "start": 111,
                    "end": 114
                  }
                }
              ]
            },
            "span": {
              "start": 104,
              "end": 114
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 90,
        "end": 117
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "d",
            "span": {
              "start": 127,
              "end": 128
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 132,
                        "end": 138
                      }
                    }
                  },
                  "span": {
                    "start": 132,
                    "end": 138
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "G"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 139,
                        "end": 141
                      }
                    }
                  },
                  "span": {
                    "start": 139,
                    "end": 141
                  }
                }
              ]
            },
            "span": {
              "start": 132,
              "end": 141
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 118,
        "end": 144
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "e",
            "span": {
              "start": 154,
              "end": 155
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 159,
                        "end": 165
                      }
                    }
                  },
                  "span": {
                    "start": 159,
                    "end": 165
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "H"
                      ],
                      "kind": "Relative",
                      "span": {
                        "start": 166,
                        "end": 177
                      }
                    }
                  },
                  "span": {
                    "start": 166,
                    "end": 177
                  }
                }
              ]
            },
            "span": {
              "start": 159,
              "end": 177
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 145,
        "end": 180
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 180
  }
}
