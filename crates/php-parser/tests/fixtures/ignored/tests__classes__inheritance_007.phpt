===source===
<?php
class A {
    function callYourPrivates() {
        $this->normalPrivate();
        $this->finalPrivate();
    }
    function notOverridden_callYourPrivates() {
        $this->normalPrivate();
        $this->finalPrivate();
    }
    private function normalPrivate() {
        echo __METHOD__ . PHP_EOL;
    }
    final private function finalPrivate() {
        echo __METHOD__ . PHP_EOL;
    }
}
class B extends A {
    function callYourPrivates() {
        $this->normalPrivate();
        $this->finalPrivate();
    }
    private function normalPrivate() {
        echo __METHOD__ . PHP_EOL;
    }
    final private function finalPrivate() {
        echo __METHOD__ . PHP_EOL;
    }
}
$a = new A();
$a->callYourPrivates();
$a->notOverridden_callYourPrivates();
$b = new B();
$b->callYourPrivates();
$b->notOverridden_callYourPrivates();
?>
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
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
                    "name": "callYourPrivates",
                    "span": {
                      "start": 29,
                      "end": 45
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
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 58,
                                  "end": 63
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "normalPrivate"
                                },
                                "span": {
                                  "start": 65,
                                  "end": 78
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 58,
                            "end": 80
                          }
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 81
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 90,
                                  "end": 95
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "finalPrivate"
                                },
                                "span": {
                                  "start": 97,
                                  "end": 109
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 90,
                            "end": 111
                          }
                        }
                      },
                      "span": {
                        "start": 90,
                        "end": 112
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 118
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "notOverridden_callYourPrivates",
                    "span": {
                      "start": 132,
                      "end": 162
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
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 175,
                                  "end": 180
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "normalPrivate"
                                },
                                "span": {
                                  "start": 182,
                                  "end": 195
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 175,
                            "end": 197
                          }
                        }
                      },
                      "span": {
                        "start": 175,
                        "end": 198
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 207,
                                  "end": 212
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "finalPrivate"
                                },
                                "span": {
                                  "start": 214,
                                  "end": 226
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 207,
                            "end": 228
                          }
                        }
                      },
                      "span": {
                        "start": 207,
                        "end": 229
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 123,
                "end": 235
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "normalPrivate",
                    "span": {
                      "start": 257,
                      "end": 270
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "MagicConst": "Method"
                                  },
                                  "span": {
                                    "start": 288,
                                    "end": 298
                                  }
                                },
                                "op": "Concat",
                                "right": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "PHP_EOL"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 301,
                                        "end": 308
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 301,
                                    "end": 308
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 288,
                              "end": 308
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 283,
                        "end": 309
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 240,
                "end": 315
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "finalPrivate",
                    "span": {
                      "start": 343,
                      "end": 355
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "MagicConst": "Method"
                                  },
                                  "span": {
                                    "start": 373,
                                    "end": 383
                                  }
                                },
                                "op": "Concat",
                                "right": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "PHP_EOL"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 386,
                                        "end": 393
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 386,
                                    "end": 393
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 373,
                              "end": 393
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 368,
                        "end": 394
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 320,
                "end": 400
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 402
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 409,
              "end": 410
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 419,
              "end": 420
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "callYourPrivates",
                    "span": {
                      "start": 436,
                      "end": 452
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
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 465,
                                  "end": 470
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "normalPrivate"
                                },
                                "span": {
                                  "start": 472,
                                  "end": 485
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 465,
                            "end": 487
                          }
                        }
                      },
                      "span": {
                        "start": 465,
                        "end": 488
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 497,
                                  "end": 502
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "finalPrivate"
                                },
                                "span": {
                                  "start": 504,
                                  "end": 516
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 497,
                            "end": 518
                          }
                        }
                      },
                      "span": {
                        "start": 497,
                        "end": 519
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 427,
                "end": 525
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "normalPrivate",
                    "span": {
                      "start": 547,
                      "end": 560
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "MagicConst": "Method"
                                  },
                                  "span": {
                                    "start": 578,
                                    "end": 588
                                  }
                                },
                                "op": "Concat",
                                "right": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "PHP_EOL"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 591,
                                        "end": 598
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 591,
                                    "end": 598
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 578,
                              "end": 598
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 573,
                        "end": 599
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 530,
                "end": 605
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "finalPrivate",
                    "span": {
                      "start": 633,
                      "end": 645
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "MagicConst": "Method"
                                  },
                                  "span": {
                                    "start": 663,
                                    "end": 673
                                  }
                                },
                                "op": "Concat",
                                "right": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "PHP_EOL"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 676,
                                        "end": 683
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 676,
                                    "end": 683
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 663,
                              "end": 683
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 658,
                        "end": 684
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 610,
                "end": 690
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 403,
        "end": 692
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 693,
                  "end": 695
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
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 702,
                            "end": 703
                          }
                        }
                      },
                      "span": {
                        "start": 702,
                        "end": 703
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 698,
                  "end": 705
                }
              }
            }
          },
          "span": {
            "start": 693,
            "end": 705
          }
        }
      },
      "span": {
        "start": 693,
        "end": 706
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 707,
                  "end": 709
                }
              },
              "method": {
                "kind": {
                  "Identifier": "callYourPrivates"
                },
                "span": {
                  "start": 711,
                  "end": 727
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 707,
            "end": 729
          }
        }
      },
      "span": {
        "start": 707,
        "end": 730
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 731,
                  "end": 733
                }
              },
              "method": {
                "kind": {
                  "Identifier": "notOverridden_callYourPrivates"
                },
                "span": {
                  "start": 735,
                  "end": 765
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 731,
            "end": 767
          }
        }
      },
      "span": {
        "start": 731,
        "end": 768
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 769,
                  "end": 771
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
                            "B"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 778,
                            "end": 779
                          }
                        }
                      },
                      "span": {
                        "start": 778,
                        "end": 779
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 774,
                  "end": 781
                }
              }
            }
          },
          "span": {
            "start": 769,
            "end": 781
          }
        }
      },
      "span": {
        "start": 769,
        "end": 782
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 783,
                  "end": 785
                }
              },
              "method": {
                "kind": {
                  "Identifier": "callYourPrivates"
                },
                "span": {
                  "start": 787,
                  "end": 803
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 783,
            "end": 805
          }
        }
      },
      "span": {
        "start": 783,
        "end": 806
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 807,
                  "end": 809
                }
              },
              "method": {
                "kind": {
                  "Identifier": "notOverridden_callYourPrivates"
                },
                "span": {
                  "start": 811,
                  "end": 841
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 807,
            "end": 843
          }
        }
      },
      "span": {
        "start": 807,
        "end": 844
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 844
  }
}
