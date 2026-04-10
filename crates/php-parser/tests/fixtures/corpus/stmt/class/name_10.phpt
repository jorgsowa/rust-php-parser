===source===
<?php interface self {}
===errors===
cannot use 'self' as interface name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "self",
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
