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
          "name": "null",
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
          "name": "true",
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
          "name": "false",
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
          "name": "readonly",
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
          "name": "self",
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
          "name": "parent",
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
