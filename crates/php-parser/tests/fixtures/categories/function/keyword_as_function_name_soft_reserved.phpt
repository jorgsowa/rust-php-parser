===source===
<?php
function null() {}
function true() {}
function false() {}
function readonly() {}
function self() {}
function parent() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "null",
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "true",
            "span": {
              "start": 34,
              "end": 38
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 25,
        "end": 43
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "false",
            "span": {
              "start": 53,
              "end": 58
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 44,
        "end": 63
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "readonly",
            "span": {
              "start": 73,
              "end": 81
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 64,
        "end": 86
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "self",
            "span": {
              "start": 96,
              "end": 100
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 87,
        "end": 105
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "parent",
            "span": {
              "start": 115,
              "end": 121
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 106,
        "end": 126
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 126
  }
}
