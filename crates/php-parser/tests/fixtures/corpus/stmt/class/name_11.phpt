===source===
<?php interface PARENT {}
===errors===
cannot use 'PARENT' as interface name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "PARENT",
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
