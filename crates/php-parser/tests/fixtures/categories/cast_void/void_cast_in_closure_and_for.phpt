===source===
<?php
$x = function () { (void) f(); };
g(function () { (void) f(); });
for ((void) f(), (void) g(); (void) f(), $i < 3; (void) h()) {}
class C { function m() { (void) f(); } }
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Expression": {
                            "kind": {
                              "Cast": [
                                "Void",
                                {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "f"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 32,
                                              "end": 33
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 32,
                                          "end": 33
                                        }
                                      },
                                      "args": []
                                    }
                                  },
                                  "span": {
                                    "start": 32,
                                    "end": 35
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 25,
                              "end": 35
                            }
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 36
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 38
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "g"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  }
                },
                "span": {
                  "start": 40,
                  "end": 41
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Closure": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [],
                          "use_vars": [],
                          "return_type": null,
                          "body": [
                            {
                              "kind": {
                                "Expression": {
                                  "kind": {
                                    "Cast": [
                                      "Void",
                                      {
                                        "kind": {
                                          "FunctionCall": {
                                            "name": {
                                              "kind": {
                                                "Name": {
                                                  "parts": [
                                                    "f"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 63,
                                                    "end": 64
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 63,
                                                "end": 64
                                              }
                                            },
                                            "args": []
                                          }
                                        },
                                        "span": {
                                          "start": 63,
                                          "end": 66
                                        }
                                      }
                                    ]
                                  },
                                  "span": {
                                    "start": 56,
                                    "end": 66
                                  }
                                }
                              },
                              "span": {
                                "start": 56,
                                "end": 67
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 42,
                        "end": 69
                      }
                    }
                  },
                  "span": {
                    "start": 42,
                    "end": 69
                  }
                }
              ]
            }
          },
          "span": {
            "start": 40,
            "end": 70
          }
        }
      },
      "span": {
        "start": 40,
        "end": 71
      }
    },
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Cast": [
                  "Void",
                  {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 84,
                                "end": 85
                              }
                            }
                          },
                          "span": {
                            "start": 84,
                            "end": 85
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 84,
                      "end": 87
                    }
                  }
                ]
              },
              "span": {
                "start": 77,
                "end": 87
              }
            },
            {
              "kind": {
                "Cast": [
                  "Void",
                  {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "g"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 96,
                                "end": 97
                              }
                            }
                          },
                          "span": {
                            "start": 96,
                            "end": 97
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 96,
                      "end": 99
                    }
                  }
                ]
              },
              "span": {
                "start": 89,
                "end": 99
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Cast": [
                  "Void",
                  {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 108,
                                "end": 109
                              }
                            }
                          },
                          "span": {
                            "start": 108,
                            "end": 109
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 108,
                      "end": 111
                    }
                  }
                ]
              },
              "span": {
                "start": 101,
                "end": 111
              }
            },
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 113,
                      "end": 115
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 118,
                      "end": 119
                    }
                  }
                }
              },
              "span": {
                "start": 113,
                "end": 119
              }
            }
          ],
          "update": [
            {
              "kind": {
                "Cast": [
                  "Void",
                  {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "h"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 128,
                                "end": 129
                              }
                            }
                          },
                          "span": {
                            "start": 128,
                            "end": 129
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 128,
                      "end": 131
                    }
                  }
                ]
              },
              "span": {
                "start": 121,
                "end": 131
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 133,
              "end": 135
            }
          }
        }
      },
      "span": {
        "start": 72,
        "end": 135
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 142,
              "end": 143
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 155,
                      "end": 156
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Cast": [
                              "Void",
                              {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "f"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 168,
                                            "end": 169
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 168,
                                        "end": 169
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 168,
                                  "end": 171
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 161,
                            "end": 171
                          }
                        }
                      },
                      "span": {
                        "start": 161,
                        "end": 172
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 146,
                "end": 174
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 136,
        "end": 176
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 176
  }
}
